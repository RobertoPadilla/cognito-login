<?php

namespace App\Controllers;

use Aws\S3\S3Client;
use App\Models\Image;
use Aws\Sts\StsClient;
use Aws\CognitoIdentity\CognitoIdentityClient;

class GalleryController extends BaseController
{
    public function index()
    {
        $image = new Image();
        $session = session();

        $images = $image->getByUser($session->get('user_id'));

        $aws = new \App\Controllers\AWSController();

        $client = new CognitoIdentityClient([
            'version' => 'latest',
            'region' => 'us-east-1',
            'credentials' => array(
                'key' => $aws->config->credentials['access_key_id'],
                'secret' => $aws->config->credentials['secret_access_key']
            )
        ]);

        $result = $client->getId([
            'AccountId' => '935041629507',
            'IdentityPoolId' => 'us-east-1:9c8d5bc3-016b-4db0-bbb5-456236107060',
            'Logins' => ['cognito-idp.us-east-1.amazonaws.com/us-east-1_eqkRP9Uyb' => $session->get('id_token')],
        ]);

        $result = $client->getCredentialsForIdentity([
            'IdentityId' => $result['IdentityId'],
            'Logins' => ['cognito-idp.us-east-1.amazonaws.com/us-east-1_eqkRP9Uyb' => $session->get('id_token')],
        ]);

        var_dump($result);
        $s3_client = new S3Client([
            'credentials' => [
                'key' => $result['Credentials']['AccessKeyId'],
                'secret' => $result['Credentials']['SecretKey'],
                'token' => $result['Credentials']['SessionToken'],
            ],
            'region' => 'us-east-1',
            'version' => 'latest',
        ]);

        $bucket = 'cognito-users-app';
        $images = $s3_client->listObjects([
            'Bucket' => $bucket,
        ]);

        $urls = [];
        foreach ($images['Contents'] as $image) {
            $cmd = $s3_client->getCommand('GetObject', [
                'Bucket' => $bucket,
                'Key' => $image['Key'],
            ]);
            $request = $s3_client->createPresignedRequest($cmd, '+20 minutes');

            array_push($urls, (string)$request->getUri());
        }

        return view('gallery', compact('urls'));
    }
}
