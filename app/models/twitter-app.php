<<<<<<< HEAD
<?php
    require_once "twitteroauth/autoload.php";
    use Abraham\TwitterOAuth\TwitterOAuth;

    class twitter
    {
        public function posteaza()
        {
            $consumerKey = "ZV2Ak4YS1k0yEToQFnmYj6zpt";
            $consumerSecret = "EKaWuizhJpT4syBcsK2pOwjxnUo7H9bRP8txlcOUJhCZyI6gjc";
            $accessToken = "1005815217807294464-uy9Gf1pNnrhrf33iyf2Rwyxfsf47oE";
            $accessTokenSecret = "kfV62xBzyM4MntYuyj3OR6sx5RdHRyUIe8WeCKJoT67BP";

            $connection = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
            $connection->get("account/verify_credentials");
            $connection->post("statuses/update", ["status" => "Hello world form Human Migration Web reporter!"]);
        }
    }
=======
<?php
    require_once "twitteroauth/autoload.php";
    use Abraham\TwitterOAuth\TwitterOAuth;

    class twitter
    {
        public function posteaza()
        {
            $consumerKey = "ZV2Ak4YS1k0yEToQFnmYj6zpt";
            $consumerSecret = "EKaWuizhJpT4syBcsK2pOwjxnUo7H9bRP8txlcOUJhCZyI6gjc";
            $accessToken = "1005815217807294464-uy9Gf1pNnrhrf33iyf2Rwyxfsf47oE";
            $accessTokenSecret = "kfV62xBzyM4MntYuyj3OR6sx5RdHRyUIe8WeCKJoT67BP";

            $connection = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
            $connection->get("account/verify_credentials");
            $connection->post("statuses/update", ["status" => "Hello world form Human Migration Web reporter!"]);
        }
    }
>>>>>>> f95e207c517a27d72ee9271816deaf091e724a1d
       ?>