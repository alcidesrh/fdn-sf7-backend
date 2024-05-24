<?php

namespace App\Enum;

enum Crud: string {
  case crear = 'crear';
  case editar = 'editar';
  case listar = 'listar';
  case ver = 'ver';
  case inactivo = 'eliminar';
}
