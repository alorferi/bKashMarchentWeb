<?php

namespace App\Models;

use Laratrust\Models\LaratrustPermission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends LaratrustPermission
{
    use HasFactory;
    use SoftDeletes;

    public $guarded = [];

    //User
    const user_create = 'user_create';
    const user_edit = 'user_edit';

    //Post
    const post_create = 'post_create';
    const post_edit = 'post_edit';
    const post_index = 'post_index';

    //Author
    const author_create = 'author_create';
    const author_edit = 'author_edit';
    const author_index = 'author_index';

    //Option
    const option_create = 'option_create';
    const option_edit = 'option_edit';
    const option_index = 'option_index';

    //Comment
    const comment_create = 'comment_create';
    const comment_edit = 'comment_edit';
    const comment_index = 'comment_index';

    //Term
    const term_create = 'term_create';
    const term_edit = 'term_edit';
    const term_index = 'term_index';

    //Role
    const role_create = 'role_create';
    const role_edit = 'role_edit';
    const role_index = 'role_index';

    //Permission
    const permission_create = 'permission_create';
    const permission_edit = 'permission_edit';
    const permission_index = 'permission_index';

    public static function getPermissionList()
    {
        $permissions = [
            Permission::user_create,
            Permission::user_edit ,

            //Post
            Permission::post_create ,
            Permission::post_edit ,
            Permission::post_index ,

            //Author
            Permission::author_create ,
            Permission::author_edit ,
            Permission::author_index ,

            //Option
            Permission::option_create,
            Permission::option_edit ,
            Permission::option_index ,

            //Comment
            Permission::comment_create ,
            Permission::comment_edit,
            Permission::comment_index ,

            //Term
            Permission::term_create,
            Permission::term_edit ,
            Permission::term_index ,

             //Role
             Permission::role_create ,
             Permission::role_edit,
             Permission::role_index ,

            //Permission
            Permission::permission_create ,
            Permission::permission_edit ,
            Permission::permission_index ,

        ];

        return $permissions;
    }
}
