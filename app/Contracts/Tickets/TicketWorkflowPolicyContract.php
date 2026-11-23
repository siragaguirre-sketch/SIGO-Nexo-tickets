<?php

namespace App\Contracts\Tickets;

use App\Models\Ticket;
use App\Models\User;

interface TicketWorkflowPolicyContract
{
    public function puedeResolver(Ticket $ticket, User $usuario): bool;

    public function puedeCerrar(Ticket $ticket, User $usuario): bool;

    public function puedeReabrir(Ticket $ticket, User $usuario): bool;

    public function puedeAsignar(Ticket $ticket, array $tecnicoIds, User $usuario): bool;
}
