<?php

namespace Tests\Unit;

use App\Models\Ticket;
use PHPUnit\Framework\TestCase;

class TicketSlaTest extends TestCase
{
    public function test_returns_hours_for_supported_priorities(): void
    {
        $this->assertSame(24, Ticket::horasParaPrioridad('24 horas'));
        $this->assertSame(168, Ticket::horasParaPrioridad('7 Días'));
        $this->assertSame(720, Ticket::horasParaPrioridad('30 Días'));
    }

    public function test_trims_priority_and_returns_null_for_unknown_or_missing_values(): void
    {
        $this->assertSame(48, Ticket::horasParaPrioridad(' 48 horas '));
        $this->assertNull(Ticket::horasParaPrioridad('prioridad inválida'));
        $this->assertNull(Ticket::horasParaPrioridad(null));
    }
}
