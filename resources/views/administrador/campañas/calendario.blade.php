@extends('layouts.app')

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario de Tareas - {{ $campania->nombre }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 1px;
            background-color: #e5e7eb;
            border: 1px solid #e5e7eb;
        }
        
        .calendar-day-header {
            background-color: #f3f4f6;
            font-weight: bold;
            text-align: center;
            padding: 0.75rem 0.5rem;
            border-bottom: 2px solid #d1d5db;
        }
        
        .calendar-day {
            background-color: white;
            min-height: 120px;
            padding: 0.5rem;
            position: relative;
        }
        
        .calendar-day.other-month {
            background-color: #f9fafb;
            color: #9ca3af;
        }
        
        .calendar-day-number {
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }
        
        .calendar-event {
            font-size: 0.75rem;
            padding: 0.25rem 0.375rem;
            margin-bottom: 0.25rem;
            border-radius: 0.25rem;
            cursor: pointer;
            transition: all 0.2s;
            color: white;
            font-weight: 500;
            line-height: 1.2;
            word-wrap: break-word;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        
        .calendar-event:hover {
            transform: scale(1.02);
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }
        
        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.12);
        }
        
        .calendar-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #1f2937;
            text-transform: capitalize;
        }
        
        .calendar-nav {
            display: flex;
            gap: 0.5rem;
        }
        
        .calendar-nav button {
            background: #3b82f6;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            cursor: pointer;
            font-weight: 500;
            transition: background-color 0.2s;
        }
        
        .calendar-nav button:hover {
            background: #2563eb;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="container mx-auto px-4 py-6">
        <!-- Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Calendario de Tareas - {{ $campania->nombre }}</h1>
            <div>
                <a href="{{ route('administrador.campañas.show', $campania->id) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md transition duration-300">
                    Volver a la campaña
                </a>
            </div>
        </div>

        <!-- Calendario -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div id="calendar" class="w-full"></div>
        </div>

        <!-- Leyenda de prioridades -->
        <div class="mt-6 bg-white p-6 rounded-lg shadow-lg">
            <h3 class="text-lg font-semibold mb-4 text-gray-800">Leyenda de Prioridades</h3>
            <div class="flex flex-wrap gap-6">
                <div class="flex items-center">
                    <div class="w-4 h-4 bg-red-500 rounded-full mr-3"></div>
                    <span class="text-gray-700 font-medium">Urgente</span>
                </div>
                <div class="flex items-center">
                    <div class="w-4 h-4 bg-orange-500 rounded-full mr-3"></div>
                    <span class="text-gray-700 font-medium">Alta</span>
                </div>
                <div class="flex items-center">
                    <div class="w-4 h-4 bg-blue-500 rounded-full mr-3"></div>
                    <span class="text-gray-700 font-medium">Media</span>
                </div>
                <div class="flex items-center">
                    <div class="w-4 h-4 bg-green-500 rounded-full mr-3"></div>
                    <span class="text-gray-700 font-medium">Baja</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Convertir los eventos de PHP a JavaScript
        const eventos = @json($eventos);
        
        let currentDate = new Date();
        let currentYear = currentDate.getFullYear();
        let currentMonth = currentDate.getMonth();

        function renderCalendar(year, month) {
            const calendarEl = document.getElementById('calendar');
            calendarEl.innerHTML = '';
            
            // Crear encabezado del calendario
            const header = document.createElement('div');
            header.className = 'calendar-header';
            
            const title = document.createElement('div');
            title.className = 'calendar-title';
            const monthNames = [
                'enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio',
                'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'
            ];
            title.textContent = `${monthNames[month]} ${year}`;
            
            const nav = document.createElement('div');
            nav.className = 'calendar-nav';
            
            const prevButton = document.createElement('button');
            prevButton.textContent = '← Anterior';
            prevButton.onclick = () => {
                if (month === 0) {
                    currentMonth = 11;
                    currentYear--;
                } else {
                    currentMonth--;
                }
                renderCalendar(currentYear, currentMonth);
            };
            
            const nextButton = document.createElement('button');
            nextButton.textContent = 'Siguiente →';
            nextButton.onclick = () => {
                if (month === 11) {
                    currentMonth = 0;
                    currentYear++;
                } else {
                    currentMonth++;
                }
                renderCalendar(currentYear, currentMonth);
            };
            
            const todayButton = document.createElement('button');
            todayButton.textContent = 'Hoy';
            todayButton.style.backgroundColor = '#10b981';
            todayButton.onclick = () => {
                const today = new Date();
                currentYear = today.getFullYear();
                currentMonth = today.getMonth();
                renderCalendar(currentYear, currentMonth);
            };
            
            nav.appendChild(prevButton);
            nav.appendChild(todayButton);
            nav.appendChild(nextButton);
            header.appendChild(title);
            header.appendChild(nav);
            calendarEl.appendChild(header);
            
            // Crear grid de días
            const grid = document.createElement('div');
            grid.className = 'calendar-grid';
            
            // Encabezados de días
            const days = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
            days.forEach(day => {
                const dayHeader = document.createElement('div');
                dayHeader.className = 'calendar-day-header';
                dayHeader.textContent = day;
                grid.appendChild(dayHeader);
            });
            
            // Obtener información del mes
            const firstDay = new Date(year, month, 1);
            const lastDay = new Date(year, month + 1, 0);
            const startDate = new Date(firstDay);
            startDate.setDate(startDate.getDate() - firstDay.getDay());
            
            // Crear 42 días (6 semanas)
            for (let i = 0; i < 42; i++) {
                const currentDay = new Date(startDate);
                currentDay.setDate(startDate.getDate() + i);
                
                const dayEl = document.createElement('div');
                dayEl.className = 'calendar-day';
                
                // Marcar días de otros meses
                if (currentDay.getMonth() !== month) {
                    dayEl.classList.add('other-month');
                }
                
                // Resaltar día actual
                const today = new Date();
                if (currentDay.toDateString() === today.toDateString()) {
                    dayEl.style.backgroundColor = '#dbeafe';
                    dayEl.style.border = '2px solid #3b82f6';
                }
                
                const dayNumber = document.createElement('div');
                dayNumber.className = 'calendar-day-number';
                dayNumber.textContent = currentDay.getDate();
                dayEl.appendChild(dayNumber);
                
                // Mostrar eventos para este día
                const currentDateStr = currentDay.toISOString().split('T')[0];
                const dayEvents = eventos.filter(event => {
                    const eventStart = event.start;
                    const eventEnd = event.end || event.start;
                    return currentDateStr >= eventStart && currentDateStr <= eventEnd;
                });
                
                dayEvents.forEach(event => {
                    const eventEl = document.createElement('div');
                    eventEl.className = 'calendar-event';
                    eventEl.style.backgroundColor = event.color || getPriorityColor(event.extendedProps.prioridad);
                    
                    // Texto más corto para mejor visualización
                    const titleParts = event.title.split(' - ');
                    eventEl.textContent = titleParts[0];
                    
                    eventEl.title = `${event.title}\nPrioridad: ${event.extendedProps.prioridad}\nEstado: ${event.extendedProps.estado}`;
                    
                    if (event.url) {
                        eventEl.onclick = () => {
                            window.location.href = event.url;
                        };
                    } else {
                        eventEl.onclick = () => {
                            alert(`Tarea: ${event.title}\nPrioridad: ${event.extendedProps.prioridad}\nEstado: ${event.extendedProps.estado}\nAsignado: ${event.extendedProps.asignado}`);
                        };
                    }
                    
                    dayEl.appendChild(eventEl);
                });
                
                grid.appendChild(dayEl);
            }
            
            calendarEl.appendChild(grid);
        }
        
        function getPriorityColor(prioridad) {
            switch(prioridad) {
                case 'urgente': return '#dc2626';
                case 'alta': return '#ea580c';
                case 'media': return '#2563eb';
                case 'baja': return '#16a34a';
                default: return '#6b7280';
            }
        }
        
        // Inicializar calendario
        document.addEventListener('DOMContentLoaded', function() {
            renderCalendar(currentYear, currentMonth);
        });
    </script>
</body>
</html>