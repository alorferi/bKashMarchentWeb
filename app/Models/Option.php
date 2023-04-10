<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    const siteurl = 'siteurl';
    const home = 'home';
    const blogname = 'blogname';
    const blogdescription = 'blogdescription';
    const users_can_register = 'users_can_register';
    const admin_email = 'admin_email';
    const start_of_week = 'start_of_week';
    const use_balanceTags = 'use_balanceTags';
    const use_smilies = 'use_smilies';
    const require_name_email = 'require_name_email';
    const comments_notify = 'comments_notify';
    const posts_per_rss = 'posts_per_rss';
    const rss_use_excerpt = 'rss_use_excerpt';
    const mailserver_url = 'mailserver_url';
    const mailserver_login = 'mailserver_login';
    const mailserver_pass = 'mailserver_pass';
    const mailserver_port = 'mailserver_port';
    const default_category = 'default_category';
    const default_comment_status = 'default_comment_status';
    const default_ping_status = 'default_ping_status';
    const default_pingback_flag = 'default_pingback_flag';
    const posts_per_page = 'posts_per_page';
    const date_format = 'date_format';
    const time_format = 'time_format';
    const links_updated_date_format = 'links_updated_date_format';
    const comment_moderation = 'comment_moderation';
    const moderation_notify = 'moderation_notify';
}
