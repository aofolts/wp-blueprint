<?php

namespace Blueprint;

class Email {

  protected $from;
  protected $headers;
  protected $to;
  protected $body;
  protected $subject;

  function getFrom() {

    if (!$this->from) {$this->setFrom();}
    return $this->from;

  }

  function setBody($body) {

    $this->body = $body;
    return $this;

  }

  function setFrom($email=null,$name=null) {

    if (!$email) {
      $email = get_field('site_email','option');
    }

    $this->from = "From: $name <$email>\r\n";

    return $this;

  }

  function setSubject($subject) {

    $this->subject = $subject;
    return $this;

  }

  function setTo($email) {

    $this->to = $email;
    return $this;

  }

  protected function prepareHeaders() {

    $this->headers = $headers = array();

    $headers[] = "MIME-Version: 1.0";
    $headers[] = "Content-Type: text/html; charset=utf-8";

    return $headers;

  }

  // Sends the email
  function send() {

    $headers = $this->prepareHeaders();

    $mail = wp_mail(
      $this->to,
      $this->subject,
      $this->body
    );

    return $mail;

  }

}
