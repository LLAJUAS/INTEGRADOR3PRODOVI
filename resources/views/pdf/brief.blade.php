<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Brief de {{ $user->name }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .section { margin-bottom: 30px; }
        .section-title { 
            background-color: #f0f0f0; 
            padding: 8px; 
            font-weight: bold;
            border-left: 4px solid #4a6baf;
        }
        .field { margin-bottom: 10px; }
        .field-label { font-weight: bold; }
        .checkbox-list { margin-left: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Brief de Cliente - PRODOVI</h1>
        <p>Generado el: {{ now()->format('d/m/Y') }}</p>
        <p>Cliente: {{ $user->name }} ({{ $user->email }})</p>
    </div>
    
    @foreach($data as $section => $fields)
    <div class="section">
        <div class="section-title">{{ ucfirst(str_replace('_', ' ', $section)) }}</div>
        @foreach($fields as $key => $value)
            <div class="field">
                <span class="field-label">{{ ucfirst(str_replace('_', ' ', $key)) }}:</span>
                @if(is_array($value))
                    <div class="checkbox-list">
                        @foreach($value as $item)
                            <div>{{ $item }}</div>
                        @endforeach
                    </div>
                @else
                    {{ $value ?? 'No especificado' }}
                @endif
            </div>
        @endforeach
    </div>
    @endforeach
</body>
</html>