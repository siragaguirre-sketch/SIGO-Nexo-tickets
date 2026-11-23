<?php

namespace Tests\Unit;

use App\Models\Ticket;
use App\Models\User;
use App\Services\Tickets\TicketWorkflowPolicy;
use PHPUnit\Framework\TestCase;

class TicketWorkflowPolicyTest extends TestCase
{
    public function test_supervisor_puede_resolver_un_ticket_nuevo(): void
    {
        $ticket = new Ticket(['estado_workflow' => Ticket::NUEVO]);
        $usuario = new User(['role' => User::ROLE_SUPERVISOR, 'activo' => true]);

        $this->assertTrue((new TicketWorkflowPolicy())->puedeResolver($ticket, $usuario));
    }

    public function test_tecnico_no_puede_cerrar_un_ticket(): void
    {
        $ticket = new Ticket(['estado_workflow' => Ticket::RESUELTO]);
        $usuario = new User(['role' => User::ROLE_TECNICO, 'activo' => true]);

        $this->assertFalse((new TicketWorkflowPolicy())->puedeCerrar($ticket, $usuario));
    }

    public function test_limite_de_tecnicos_depende_del_area(): void
    {
        $policy = new TicketWorkflowPolicy();
        $supervisor = new User(['role' => User::ROLE_SUPERVISOR, 'activo' => true]);

        $limpieza = new Ticket([
            'estado_workflow' => Ticket::NUEVO,
            'origen_hoja' => 'LIMP (M01PR012)',
        ]);
        $mantenimiento = new Ticket([
            'estado_workflow' => Ticket::NUEVO,
            'origen_hoja' => 'MANT (M01PR004)',
        ]);

        $this->assertFalse($policy->puedeAsignar($limpieza, [1, 2], $supervisor));
        $this->assertTrue($policy->puedeAsignar($mantenimiento, [1, 2], $supervisor));
    }
}
