# Registro de defectos y validacion

## Plantilla

Cada defecto encontrado debe registrarse en el Pull Request o en un Issue con esta estructura:

| Campo | Contenido |
|---|---|
| Identificador | `BUG-001` |
| Componente | Archivo, endpoint o flujo afectado |
| Pasos | Acciones exactas para reproducir |
| Resultado esperado | Comportamiento correcto |
| Resultado obtenido | Error o comportamiento real |
| Evidencia | Captura, log o salida de CI |
| Severidad | Crítica, alta, media o baja |
| Estado | Abierto, corregido o cerrado |
| Correccion | Commit o Pull Request que resuelve el defecto |
| Retest | Prueba ejecutada para confirmar la corrección |

## Niveles de prueba

| Nivel | Herramienta | Objetivo |
|---|---|---|
| Unitarias | PHPUnit | Políticas, roles, límites y cálculo de SLA |
| Funcionales | PHPUnit + Laravel TestCase | Autorizaciones y transiciones del workflow |
| Integración | PostgreSQL + PostGIS | Migraciones y persistencia real |
| Frontend | Vite build | Compilación de assets y dependencias |
| Pipeline | GitHub Actions | Validación automática en cada push y Pull Request |

## Comandos locales

```powershell
php vendor/bin/phpunit
php vendor/bin/phpunit --configuration phpunit.pgsql.xml
pnpm install --frozen-lockfile
pnpm run build
```

Un defecto queda corregido solo después de ejecutar el nivel de prueba correspondiente y observar un resultado exitoso en CI.
