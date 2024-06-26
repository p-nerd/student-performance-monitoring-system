<?php

namespace App\Enums;

enum Role: string
{
    case GUEST = "guest";
    case STUDENT = 'student';
    case TEACHER = 'teacher';
    case ADMIN = 'admin';
}
