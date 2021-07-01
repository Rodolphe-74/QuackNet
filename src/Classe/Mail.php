<?php

//require 'vendor/autoload.php';
//
//use \Mailjet\Resources;
//
//class Mail
//{
//    private $api_key = "3d63e1a327853220bb88b4653d20361f";
//    private $api_key_private = "7d506546f726c73fb295526e8b228010";
//
//    public function send($mailTo,$name,$subject,$content)
//    {
//
//        $mj= new \Mailjet\Client($this->api_key, $this->api_key_private,true, ['version' => 'v3.1']);
//
//        $body = [
//            'Messages' => [
//                [
//                    'From' => [
//                        'Email' => "rodolphe.gacougnolle@le-campus-numerique.fr",
//                        'Name' => "Rodolphe"],
//                    'To' => [
//                        [
//                            'Email' => $mailTo,
//                            'Name' => $name
//                        ]
//                    ],
//                    'Subject' => $subject,
//                    'Variables' => [
//                        'content' => $content,
//                    ]
//                ]
//            ]
//        ];
//
//        $response = $mj->post(Resources::$Email, ['body' => $body]);
//        $response->success() && var_dump($response->getData());
//    }
//
//
//}
?>