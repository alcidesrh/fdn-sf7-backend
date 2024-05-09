<?php

namespace App\Enum;

enum EncomiendaStatus: string {
  case recibida = 'recibida';
  case embarcada = 'embarcada';
  case transito = 'transito';
  case desembarcada = 'desembarcada';
  case entregada = 'entregada';
  case cancelada = 'cancelada';
}
