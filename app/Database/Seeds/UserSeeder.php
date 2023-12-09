<?php 
namespace App\Database\Seeds;

class UserSeeder extends \CodeIgniter\Database\Seeder{
    public function run(){
        $userModel = model('Myth\Auth\Models\UserModel');
        $authorization = service('authorization');
        
        $userModel->insert([
            'name' => 'Admin',
            'username' => 'admin_satumedia',
            'email' => 'admin@satumedia.id',
            'initial' => 'adm',
            'user_hash' => md5('admin@satumedia.id'),
            'password_hash' => \Myth\Auth\Password::hash('admin12345'),
            'active' => 1,
        ]);
        $authorization->addUserToGroup($userModel->insertID(), 'admin');

        
        $userModel->insert([
            'name' => 'Redactur',
            'username' => 'redaktur_satumedia',
            'email' => 'redaktur@satumedia.id',
            'initial' => 'rdtr',
            'user_hash' => md5('redaktur@satumedia.id'),
            'password_hash' => \Myth\Auth\Password::hash('redaktur12345'),
            'active' => 1,
        ]);
        $authorization->addUserToGroup($userModel->insertID(), 'redaktur');

        $userModel->insert([
            'name' => 'Contributor',
            'username' => 'contributor_satumedia',
            'email' => 'contributor@satumedia.id',
            'initial' => 'ctr',
            'user_hash' => md5('contributor@satumedia.id'),
            'password_hash' => \Myth\Auth\Password::hash('contributor12345'),
            'active' => 1,
        ]);
        $authorization->addUserToGroup($userModel->insertID(), 'contributor');

        $userModel->insert([
            'name' => 'Editor',
            'username' => 'editor_satumedia',
            'email' => 'editor@satumedia.id',
            'initial' => 'edt',
            'user_hash' => md5('editor@satumedia.id'),
            'password_hash' => \Myth\Auth\Password::hash('editor12345'),
            'active' => 1,
        ]);
        $authorization->addUserToGroup($userModel->insertID(), 'editor');

    }
}