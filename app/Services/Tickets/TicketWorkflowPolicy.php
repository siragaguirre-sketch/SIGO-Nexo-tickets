<?php

namespace App\Services\Tickets;

use App\Contracts\Tickets\TicketWorkflowPolicyContract;
use App\Models\Ticket;
use App\Models\User;

class TicketWorkflowPolicy implements TicketWorkflowPolicyContract
{
    public function puedeResolver(Ticket $ticket, User $usuario): bool
    {
        return $usuario->puedeGestionar() && $ticket->puedeResolverse();
    }

    public function puedeCerrar(Ticket $ticket, User $usuario): bool
    {
        return $usuario->isAdmin() && $ticket->puedeCerrarse();
    }

    public function puedeReabrir(Ticket $ticket, User $usuario): bool
    {
        return $usuario->isAdmin() && $ticket->puedeReabrirse();
    }

    public function puedeAsignar(Ticket $ticket, array $tecnicoIds, User $usuario): bool
    {
        if (! $usuario->puedeGestionar()) {
            return false;
        }

        $tecnicoIds = array_values(array_unique(array_map('intval', $tecnicoIds)));

        return count($tecnicoIds) <= $ticket->limiteTecnicos();
    }
}
