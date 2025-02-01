<?php

namespace App\Enums;

enum UserRole: String
{
    case teknisi = 'Teknisi LabKom';
    case kepala = 'Kepala LabKom';
    case peminjam = 'Peminjam';
}
