<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class InstadeckInstagramApiController extends Controller
{
    public function index()
    {
        $appId = config('services.facebook.client_id');
        $redirectUri = config('services.facebook.redirect_uri');
        return redirect()->to("https://www.facebook.com/v8.0/dialog/oauth?client_id={$appId}&redirect_uri={$redirectUri}&scope=pages_read_engagement,instagram_basic,ads_management,business_management,pages_show_list");
    }

    public function callback(Request $request)
    {
        $client = new Client();
        $appId = config('services.facebook.client_id');
        $secret = config('services.facebook.client_secret');
        $redirectUri = config('services.facebook.redirect_uri');
        $code = $request->code;
        if (empty($code)) return redirect()->route('home')->with('error', 'Failed to login with Instagram.');

        $response = $client->request('GET', "https://graph.facebook.com/v8.0/oauth/access_token?client_id={$appId}&client_secret={$secret}&redirect_uri={$redirectUri}&code={$code}");

        if ($response->getStatusCode() != 200) {
            return redirect()->route('home')->with('error', 'Unauthorized login to Instagram.');
        }

        $content = $response->getBody()->getContents();
        $token = json_decode($content);

        $instaId = config('services.facebook.instagram_id');
        $accessToken = $token->access_token;

        $getProfile = $client->request('GET', "https://graph.facebook.com/v8.0/{$instaId}?fields=id,ig_id,profile_picture_url,username,media_count,followers_count,follows_count,name,biography,website&access_token={$accessToken}");
        $profileData = $getProfile->getBody()->getContents();
        $profile = json_decode($profileData);

        dd($profile["data"]["username"]);

        $getMedia = $client->request('GET', "https://graph.facebook.com/v8.0/{$instaId}/media?access_token={$accessToken}");
        $mediaData = $getMedia->getBody()->getContents();
        $media = json_decode($mediaData);

        return view('/instadeck/profile', compact('profile', 'media'));
    }
}