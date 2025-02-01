<?php

namespace App\Enums;

enum UserRole: String
{
    case admin = 'admin';
    case teknisi = 'Teknisi LabKom';
    case kepala = 'Kepala LabKom';
    case peminjam = 'Peminjam';
}
