<?php

namespace App\Enums;

enum DwellingStatus: string
{
   case Requested = 'requested';
   case InProgress = 'in progress';
   case Completed = 'completed';
   case Rejected = 'rejected';

   public function status(): string
   {
       return match($this) 
       {
           DwellingStatus::Requested => __('Requested'),
           DwellingStatus::InProgress => __('In progress'),
           DwellingStatus::Completed => __('Completado'),
           DwellingStatus::Rejected => __('Rechazado')
       };
   }

   public function canTransitionTo(self $newStatus): bool
   {
       return match ($this) {
           self::Requested => in_array($newStatus, [self::InProgress, self::Rejected]),
           self::InProgress => in_array($newStatus, [self::Completed, self::Rejected]),
           self::Completed, self::Rejected => false,
       };
   }

   public static function values(): array
   {
       return array_column(self::cases(), 'value', 'name');
   }
}