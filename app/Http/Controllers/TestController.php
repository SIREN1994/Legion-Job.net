<?php

namespace App\Http\Controllers;

use Exception;
use SendGrid;
use SendGrid\Mail\Mail;
use Illuminate\Http\Request;

class TestController extends Controller
{


    public function sendEmail(Request $request)
    {
        $email = new Mail();
        $email->setFrom("test@example.com", "Example User");
        $email->setSubject("Sending with SendGrid is Fun");
        $email->addTo("forbiddensiren13@gmail.com", "Recipient");
        $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
        $email->addContent(
            "text/html",
            "<strong>and easy to do anywhere, even with PHP</strong>"
        );

        // Initialize SendGrid client with SSL verification disabled
        $sendgrid = new SendGrid(getenv('SENDGRID_API_KEY'), ['http' => ['verify_peer' => false]]);

        try {
            $response = $sendgrid->send($email);
            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
        } catch (Exception $e) {
            echo 'Caught exception: ' . $e->getMessage() . "\n";
        }
    }
}
