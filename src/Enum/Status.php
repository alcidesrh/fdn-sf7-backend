<?php

namespace App\Enum;

enum Status: string {
  case creado = 'creado';
  case progreso = 'progreso';
  case finalizado = 'finalizado';
  case activo = 'activo';
  case inactivo = 'inactivo';
  case cancelado = 'cancelado';
  case error = 'error';
  case pausa = 'pausa';
  case confirmado = 'confirmado';
  case expirado = 'expirado';
  case reasignado = 'reasignado';
}
