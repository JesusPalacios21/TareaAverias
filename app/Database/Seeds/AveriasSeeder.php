<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AveriasSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'cliente'   => 'Juan Pérez',
                'problema'  => 'No enciende el equipo',
                'fechahora' => '2025-10-17 09:30:00',
                'status'    => 'pendiente',
            ],
            [
                'cliente'   => 'Ana Gómez',
                'problema'  => 'Pantalla rota',
                'fechahora' => '2025-10-16 15:45:00',
                'status'    => 'solucionado',
            ],
            [
                'cliente'   => 'Luis Martínez',
                'problema'  => 'No carga la batería',
                'fechahora' => '2025-10-15 11:00:00',
                'status'    => 'pendiente',
            ],
        ];

        $this->db->table('averias')->insertBatch($data);
    }
}
