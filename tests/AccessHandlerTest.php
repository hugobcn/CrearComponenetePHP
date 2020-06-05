<?php

use PHPUnit\Framework\TestCase as BaseTestcase;
use App\AccessHandler as Access;
use App\Authenticator as Auth;
use App\SessionManager as Session;
use App\SessionFileDriver as Driver;
use App\SessionArrayDriver;
use App\Stubs\AuthenticatorStub as AuthStub;
use App\AuthenticatorInterface as AuthInter;
use Mockery;

class AccessHandlerTest extends BaseTestcase
{
    
    protected function tearDown(): void
    {
        Mockery::close();
    }
    
    protected function getAuthMock(){
        
        //composer require mockery/mockery --dev
        $user = Mockery::mock(User::class);
        $user->role='admin';
        
        //$auth = Mockery::mock(Auth::class);
        $auth = Mockery::mock(AuthInter::class);
        $auth->shouldReceive('check')
             ->once()
             ->andReturn(true);
        
        $auth->shouldReceive('user')
             ->once()
             ->andReturn($user);
        
         return $auth;
        
    }


    public function test_grant_access()
    {
        
        /*
        $driver = new SessionArrayDriver([
            'user_data' => [
                'name' => 'hugo',
                'role' =>'admin'
            ]
            
        ]);
        
        $session = new Session($driver);
        
        $auth = new Auth($session); */
        
        //$auth = new AuthStub();
    
        //$access =new Access($auth);

        $access =new Access($this->getAuthMock());
        
        
        $this->assertTrue(
            //Access::check('admin')
            $access->check('admin')
        );
         
        /*
         $this->assertTrue(
            $this->access->check('admin')
        );
         * */
         
    }

    public function test_deny_access()
    {
        /*
          $driver = new SessionArrayDriver([
            'user_data' => [
                'name' => 'hugo',
                'role' =>'admin'
            ]
            
        ]);
        
        $session = new Session($driver);
        
        $auth = new Auth($session); 
        */
        $auth = new AuthStub();
        
        //composer require mockery/mockery --dev
       
        
        //$access =new Access($auth);
        $access =new Access($this->getAuthMock());
        
        $this->assertFalse(
            //Access::check('editor')    
            $access->check('editor')
        );
    }

}