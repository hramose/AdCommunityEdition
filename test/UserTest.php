<?php

use ReallySimpleJWT\TokenBuilder;
use PHPUnit\Framework\TestCase;
use ReallySimpleJWT\Token;


class UserTest extends TestCase{

    private $secret = "#%%$88979796767RUIIIMttrtry"; // seu segredo aqui

  public function testJwtAuth(){

      $builder = new TokenBuilder();

      $user = 'admin';
      $senha = 'mozart3600';
      $secret = '#260787Rosa#';
      $expired =  strtotime('2 hours');

     // echo(date("Y-m-d h:m:s",$expired));

      $token = $builder->addPayload(['key' => $user, 'value' => $senha])
          ->setSecret($secret)
          ->setExpiration($expired)
          ->setIssuer('indev.net.br')
          ->build();

      echo $token;

      $this->assertNotEmpty($token);

  }

  function testCheckToken(){
      $secret = '#260787Rosa#';

      $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJhZG1pbiI6Im1vemFydDM2MDAiLCJpc3MiOiJpbmRldi5uZXQuYnIiLCJleHAiOjE1NDIyMjkzMTAsInN1YiI6IiIsImF1ZCI6IiJ9.DJfHJzWUUnEJ6BJ2fSEeAWTTbwb1slLliwEbwAD0v8s';
      $result = Token::validate($token, $secret);

      $this->assertTrue($result);
  }
}
