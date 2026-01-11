<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Support\Facades\Blade;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->font('Plus Jakarta Sans')
            ->colors([
                'primary' => Color::Cyan, 
                'gray' => Color::Slate,
            ])
            // Mengaktifkan Dark Mode secara default agar UI tetap konsisten
            ->darkMode(true)
            ->renderHook(
                'panels::head.done',
                fn () => Blade::render('
                    <style>
                        /* 1. GLOBAL BACKGROUND (Dashboard & Sidebar) */
                        .fi-layout, .fi-sidebar, .fi-topbar, .fi-main {
                            background: #020617 !important;
                        }

                        /* Efek Cahaya di belakang (Ambient Light) */
                        body::before {
                            content: "";
                            position: fixed;
                            top: 0; left: 0; width: 100%; height: 100%;
                            background: radial-gradient(circle at 10% 10%, rgba(34, 211, 238, 0.05) 0%, transparent 50%),
                                        radial-gradient(circle at 90% 90%, rgba(99, 102, 241, 0.05) 0%, transparent 50%);
                            pointer-events: none;
                            z-index: 0;
                        }

                        /* 2. SIDEBAR CUSTOMIZATION */
                        .fi-sidebar {
                            border-right: 1px solid rgba(255, 255, 255, 0.05) !important;
                            backdrop-filter: blur(10px);
                        }

                        /* Sidebar Item (Navigasi) */
                        .fi-sidebar-item-button {
                            border-radius: 12px !important;
                            margin: 4px 8px !important;
                            transition: all 0.3s ease !important;
                        }

                        /* Item Aktif (Glowing Indigo) */
                        .fi-sidebar-item-active {
                            background: linear-gradient(90deg, rgba(34, 211, 238, 0.1) 0%, transparent 100%) !important;
                            border-left: 3px solid #22d3ee !important;
                            color: #22d3ee !important;
                        }

                        /* 3. CARD & WIDGET (Glassmorphism di Dashboard) */
                        .fi-wi-stats-overview-stat, .fi-card {
                            background: rgba(15, 23, 42, 0.6) !important;
                            backdrop-filter: blur(20px) !important;
                            border: 1px solid rgba(255, 255, 255, 0.05) !important;
                            border-radius: 20px !important;
                            box-shadow: 0 10px 30px -10px rgba(0,0,0,0.5) !important;
                        }

                        /* 4. TOPBAR (Header) */
                        .fi-topbar {
                            background: rgba(2, 6, 23, 0.8) !important;
                            backdrop-filter: blur(10px) !important;
                            border-bottom: 1px solid rgba(255, 255, 255, 0.05) !important;
                        }

                        /* 5. LOGIN PAGE SPECIFIC (Hanya muncul di login) */
                        .fi-admin-auth-login-box {
                            background: rgba(15, 23, 42, 0.4) !important;
                            backdrop-filter: blur(40px) saturate(180%) !important;
                            border: 1px solid rgba(255, 255, 255, 0.1) !important;
                            border-radius: 3rem !important;
                            box-shadow: 0 0 80px rgba(0, 0, 0, 0.5) !important;
                        }

                        .fi-logo {
                            font-size: 2.5rem !important;
                            font-weight: 800 !important;
                            text-shadow: 0 0 20px rgba(34, 211, 238, 0.4) !important;
                        }

                        button[type="submit"] {
                            background: linear-gradient(135deg, #06b6d4 0%, #3b82f6 100%) !important;
                            border-radius: 1rem !important;
                            transition: all 0.3s ease !important;
                        }
                        
                        button[type="submit"]:hover {
                            transform: translateY(-2px);
                            box-shadow: 0 10px 25px -5px rgba(6, 182, 212, 0.5) !important;
                        }
                    </style>
                ')
            )
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                \Filament\Widgets\AccountWidget::class,
                \Filament\Widgets\FilamentInfoWidget::class,
                \App\Filament\Widgets\DashboardStatsOverview::class,
                \App\Filament\Widgets\TransactionChart::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}