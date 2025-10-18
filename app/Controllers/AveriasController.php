<?php

namespace App\Controllers;

use App\Models\AveriasModel;
use CodeIgniter\Controller;
use WebSocket\Client;
class AveriasController extends Controller
{
  protected $averiasModel;

  public function __construct()
  {
    $this->averiasModel = new AveriasModel();
  }

  // Mostrar formulario para registrar
  public function registrar()
  {
    echo view('registrar');
  }

  // Guardar nuevo registro
  public function guardar()
  {
    $data = [
      'cliente' => $this->request->getPost('cliente'),
      'problema' => $this->request->getPost('problema'),
      'fechahora' => $this->request->getPost('fechahora'),
      'status' => 'pendiente',
    ];

    $idInsertado = $this->averiasModel->insert($data);
    $data['id'] = $idInsertado;

    // Notificar al WebSocket
    $this->notifySocket([
      'action' => 'nuevo',
      'averia' => $data,
    ]);

    return redirect()->to('/listar/clientes');
  }

  // Listar pendientes para clientes normales
  public function listarClientes()
  {
    $data['averias'] = $this->averiasModel->where('status', 'pendiente')->findAll();
    $data['esTecnico'] = false;
    echo view('listar', $data);
  }

  // Listar pendientes para técnicos
  public function listarTecnicos()
  {
    $data['averias'] = $this->averiasModel->where('status', 'pendiente')->findAll();
    $data['esTecnico'] = true;
    echo view('listar', $data);
  }

  // Marcar avería como solucionada
  public function solucionar($id)
  {
    $this->averiasModel->update($id, ['status' => 'solucionado']);

    // Notificar al WebSocket
    $this->notifySocket([
      'action' => 'solucionado',
      'id' => (int) $id,
    ]);

    return redirect()->to('/listar/tecnicos');
  }

  // Función para conectar y enviar mensaje al servidor WebSocket
  protected function notifySocket(array $data)
  {
    try {
      $client = new Client("ws://127.0.0.1:8080");
      $client->send(json_encode($data));
      $client->close();
      return true;
    } catch (\Exception $e) {
      log_message('error', "Error notificando WebSocket: " . $e->getMessage());
      return false;
    }
  }
}
