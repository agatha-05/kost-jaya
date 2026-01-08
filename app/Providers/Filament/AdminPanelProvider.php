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
                'primary' => Color::Cyan, // Warna Cyan Elektrik
                'gray' => Color::Slate,
            ])
            ->renderHook(
                'panels::auth.login.before',
                fn () => Blade::render('
                    <style>
                        /* 1. Animasi Mesh Gradient Background */
                        body {
                            background: #020617 !important;
                            overflow: hidden;
                        }

                        body::after {
                            content: "";
                            position: absolute;
                            width: 150%;
                            height: 150%;
                            top: -25%;
                            left: -25%;
                            background: radial-gradient(circle at 20% 30%, rgba(34, 211, 238, 0.15) 0%, transparent 40%),
                                        radial-gradient(circle at 80% 70%, rgba(99, 102, 241, 0.15) 0%, transparent 40%),
                                        radial-gradient(circle at 50% 10%, rgba(168, 85, 247, 0.1) 0%, transparent 50%);
                            animation: meshMove 20s ease infinite alternate;
                            z-index: -2;
                        }

                        @keyframes meshMove {
                            0% { transform: translate(0, 0) rotate(0deg); }
                            100% { transform: translate(5%, 5%) rotate(5deg); }
                        }

                        /* 2. Login Card Styling (Futuristic Floating) */
                        .fi-admin-auth-login-box {
                            background: rgba(15, 23, 42, 0.4) !important;
                            backdrop-filter: blur(40px) saturate(180%) !important;
                            -webkit-backdrop-filter: blur(40px) saturate(180%) !important;
                            border: 1px solid rgba(255, 255, 255, 0.1) !important;
                            border-radius: 3rem !important;
                            box-shadow: 0 0 80px rgba(0, 0, 0, 0.5), inset 0 0 20px rgba(255, 255, 255, 0.05) !important;
                            padding: 3rem !important;
                            position: relative;
                        }

                        /* Glowing Border Effect */
                        .fi-admin-auth-login-box::before {
                            content: "";
                            position: absolute;
                            inset: -1px;
                            border-radius: 3rem;
                            padding: 1px;
                            background: linear-gradient(135deg, rgba(34, 211, 238, 0.5), transparent, rgba(99, 102, 241, 0.5));
                            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
                            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
                            -webkit-mask-composite: xor;
                            mask-composite: exclude;
                            pointer-events: none;
                        }

                        /* 3. Logo Typography (Hyper Digital) */
                        .fi-logo {
                            font-size: 2.8rem !important;
                            font-weight: 800 !important;
                            letter-spacing: -2px !important;
                            color: white !important;
                            text-shadow: 0 0 20px rgba(34, 211, 238, 0.6) !important;
                            display: flex;
                            justify-content: center;
                        }

                        /* 4. Form Controls (Cyberpunk Style) */
                        .fi-input-wrapper {
                            background: rgba(2, 6, 23, 0.6) !important;
                            border: 1px solid rgba(255, 255, 255, 0.05) !important;
                            border-radius: 1.25rem !important;
                            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                        }

                        .fi-input-wrapper:focus-within {
                            border-color: #22d3ee !important;
                            box-shadow: 0 0 20px rgba(34, 211, 238, 0.2) !important;
                            transform: scale(1.02);
                        }

                        /* 5. Submit Button (Glass-Liquid Style) */
                        button[type="submit"] {
                            background: linear-gradient(135deg, #06b6d4 0%, #3b82f6 100%) !important;
                            box-shadow: 0 10px 30px -10px rgba(6, 182, 212, 0.5) !important;
                            border-radius: 1.25rem !important;
                            height: 3.5rem !important;
                            font-size: 1rem !important;
                            font-weight: 700 !important;
                            text-transform: uppercase !important;
                            letter-spacing: 2px !important;
                            transition: all 0.3s ease !important;
                        }

                        button[type="submit"]:hover {
                            box-shadow: 0 15px 40px -10px rgba(6, 182, 212, 0.7) !important;
                            transform: translateY(-3px) scale(1.03);
                            filter: brightness(1.1);
                        }

                        button[type="submit"]:active {
                            transform: scale(0.98);
                        }

                        /* 6. Text Links */
                        .fi-link {
                            color: rgba(255, 255, 255, 0.5) !important;
                            font-size: 0.85rem !important;
                            transition: color 0.3s ease;
                        }

                        .fi-link:hover {
                            color: #22d3ee !important;
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