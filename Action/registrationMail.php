<?php
/**
 * Created by PhpStorm.
 * User: Haziq
 * Date: 12/29/2015
 * Time: 11:07 PM
 */

require_once($_SERVER['DOCUMENT_ROOT'].'/matrimonialweb/swiftmailer/lib/swift_required.php');

if(!session_start())
{
    session_start();
}
    $data = array();
    $Object = new SendRegistrationMail();
    $Object->SendMail();
    array_push($data, ["Status"=>"ok"]);
    echo json_encode($data);

/**
 * Send the account verification mail to the newly joined member
 * Class SendRegistrationMail
 */
class SendRegistrationMail
{

    private $from;
    private $to;
    private $subject;
    private $body;
    private $userName;

    public function __construct()
    {
        $this->setRecipient();
        $this->setMessageBody();
        $this->from = "support@mabsapps.com";
    }

    /**
     * Send mail to the newly registered member
     */
    public function SendMail()
    {
        //Mail1234
        //$html = '<html> <body> <p> This is a fake email just for testing purpose </p></body>';
        $transport = Swift_SmtpTransport::newInstance('smtp.ipage.com', 465, 'ssl');
        $transport->setUsername('support@mabsapps.com');
        $transport->setPassword('Mail1234');

        $swift = Swift_Mailer::newInstance($transport);
        $message = new Swift_Message($this->subject);
        $message->setFrom($this->from);
        $message->setBody($this->body, 'text/html');
        $message->setTo($this->to);
        $message->addPart("testing text", 'text/plain');
        $swift->send($message, $failures);
    }

    private function setRecipient()
    {
        $this->userName     = $_SESSION['basicInfo'][1]['Username'];
        $this->to           = $_SESSION['basicInfo'][1]['Email'];
    }

    private function setMessageBody()
    {
        $this->subject = "ShadiPlan Account Conformation";
        $id = $_SESSION['id'];
        $link = "http://shadishadi.base.pk/matrimonialweb/activate.php?id=".$id;
        $html = "<html><body> <h1> Profile activation </h1> <p> In order to activate it kindly visit the link below</p>";
        $link .= "<a href='$link'/>Click here to activate your profile ";
        $html = $html . $link . "</body>";
        $this->body = $html;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return mixed
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param mixed $to
     */
    public function setTo($to)
    {
        $this->to = $to;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param mixed $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    /**
     * @return string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param string $from
     */
    public function setFrom($from)
    {
        $this->from = $from;
    }
}