<?php
use think\facade\Route;

Route::get('info/:id$','info/read')->cache(16000);