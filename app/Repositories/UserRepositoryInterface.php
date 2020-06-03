<?php
/**
 * Created by PhpStorm.
 * User: saeed
 * Date: 6/3/2020
 * Time: 11:54 AM
 */

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function users();

    public function signUp($request);

    public function update($request, $id);

    public function delete($id);
}