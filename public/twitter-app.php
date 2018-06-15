
<?php
    require_once "twitteroauth/autoload.php";
    use Abraham\TwitterOAuth\TwitterOAuth;

    class twitter
    {
        var $mesaj;
        public function posteaza($mesaj)
        {
            $this->mesaj = $mesaj;
            require_once "twitteroauth/autoload.php";
            //use Abraham\TwitterOAuth\TwitterOAuth;
            $consumerKey = "ZV2Ak4YS1k0yEToQFnmYj6zpt";
            $consumerSecret = "EKaWuizhJpT4syBcsK2pOwjxnUo7H9bRP8txlcOUJhCZyI6gjc";
            $accessToken = "1005815217807294464-uy9Gf1pNnrhrf33iyf2Rwyxfsf47oE";
            $accessTokenSecret = "kfV62xBzyM4MntYuyj3OR6sx5RdHRyUIe8WeCKJoT67BP";

            $connection = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
            $connection->get("account/verify_credentials");
            $connection->post("statuses/update", ["status" => $mesaj]);
        }
    }
