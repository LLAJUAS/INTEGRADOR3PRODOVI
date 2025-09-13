
@push('styles')
<style>
    .status-active {
        background: linear-gradient(135deg, #10B981, #059669);
        color: white;
        box-shadow: 0 2px 4px rgba(16, 185, 129, 0.2);
    }
    .status-inactive {
        background: linear-gradient(135deg, #EF4444, #DC2626);
        color: white;
        box-shadow: 0 2px 4px rgba(239, 68, 68, 0.2);
    }
    .status-no-plan {
        background: linear-gradient(135deg, #6B7280, #4B5563);
        color: white;
        box-shadow: 0 2px 4px rgba(107, 114, 128, 0.2);
    }
    .status-admin {
        background: linear-gradient(135deg, #8B5CF6, #7C3AED);
        color: white;
        box-shadow: 0 2px 4px rgba(139, 92, 246, 0.2);
    }
    
    .card-glass {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #3B82F6, #1D4ED8);
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
    }
    
    .btn-secondary {
        background: linear-gradient(135deg, #F3F4F6, #E5E7EB);
        color: #374151;
        transition: all 0.3s ease;
    }
    
    .btn-secondary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    
    .search-input {
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }
    
    .search-input:focus {
        border-color: #3B82F6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        transform: translateY(-1px);
    }
    
    .table-row {
        transition: all 0.2s ease;
    }
    
    .table-row:hover {
        background: linear-gradient(135deg, #F8FAFC, #F1F5F9);
        transform: translateX(4px);
    }
    
    .action-btn {
        transition: all 0.2s ease;
        padding: 6px 12px;
        border-radius: 6px;
        font-weight: 500;
    }
    
    .action-btn:hover {
        transform: translateY(-1px);
    }
    
    .stats-card {
        background: linear-gradient(135deg, #FFFFFF, #F8FAFC);
        border: 1px solid #E2E8F0;
        transition: all 0.3s ease;
    }
    
    .stats-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
    
    .icon-gradient {
        background: linear-gradient(135deg, #3B82F6, #8B5CF6);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fade-up {
        animation: fadeInUp 0.6s ease-out;
    }
    
    .table-container {
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 25px rgba(0, 0, 0, 0.05);
    }
</style>
@endpush