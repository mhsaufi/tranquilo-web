<?php

namespace App\Http\Controllers;

use App\Http\Controllers\SystemController as System;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as Db;

class MailingController extends Controller
{
	public function MailerDaemon(){

		$mailer = Db::table('tranquilo_users')->where('id',3)->first();

		return $mailer;

	}

    public function MailReviewed($recipient,$app_id){

    	$system = new System;
    	$application = $system->getApplication($app_id);

    	$subject = "Tranquilo Application";

    	$content = "Your application for ".$application->m_title." on ".$application->application_date." had been reviewed by owner";
    	$content .= "<br><br><br>";
    	$content .= "<i class='fa icon-phone'></i>".$this->MailerDaemon()->phone_no;
    	$content .= "<br><br><small><em>".$this->MailerDaemon()->email."</em></small>";

    	Db::table('tranquilo_message')
    	->insert([
					'message_sender'=>$this->MailerDaemon()->id,
					'message_recipient'=>$recipient,
					'message_subject'=>$subject,
					'message_content'=>$content,
					'message_status'=>1
				]);

    }

    public function MailAccepted($app_id,$recipient){

        $system = new System;
        $application = $system->getApplication($app_id);

        $subject = "Tranquilo Application";

        $content = "Your application for ".$application->m_title." on ".$application->application_date." has been accepted by owner";
        $content .= "<br><br><br>";
        $content .= "<i class='fa icon-phone'></i>".$this->MailerDaemon()->phone_no;
        $content .= "<br><br><small><em>".$this->MailerDaemon()->email."</em></small>";

        Db::table('tranquilo_message')
        ->insert([
                    'message_sender'=>$this->MailerDaemon()->id,
                    'message_recipient'=>$recipient,
                    'message_subject'=>$subject,
                    'message_content'=>$content,
                    'message_status'=>1
                ]);

    }

    public function MailRejected($app_id,$recipient){

        $system = new System;
        $application = $system->getApplication($app_id);

        $subject = "Tranquilo Application";

        $content = "Your application for ".$application->m_title." on ".$application->application_date." has been rejected by owner<br>";
        $content .= "We apologized for the declined. Try and look for more property on our site.";
        $content .= "<br>Thank you.";
        $content .= "<br><br><br>";
        $content .= "<i class='fa icon-phone'></i>".$this->MailerDaemon()->phone_no;
        $content .= "<br><br><small><em>".$this->MailerDaemon()->email."</em></small>";

        Db::table('tranquilo_message')
        ->insert([
                    'message_sender'=>$this->MailerDaemon()->id,
                    'message_recipient'=>$recipient,
                    'message_subject'=>$subject,
                    'message_content'=>$content,
                    'message_status'=>1
                ]);

    }

    public function MailDirectMessage($recipient,$sender,$content,$subject){

    }
}
