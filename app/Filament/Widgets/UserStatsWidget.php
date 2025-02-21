<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalUsers = User::count();
        $proUsers = User::where('is_premium', true)
            ->whereNotNull('subscription_expires_at')
            ->where('subscription_expires_at', '>', now())
            ->count();
        $adminUsers = User::where('role', 'admin')->count();

        $percentagePro = $totalUsers > 0 ? round(($proUsers / $totalUsers) * 100, 1) : 0;
        $percentageAdmin = $totalUsers > 0 ? round(($adminUsers / $totalUsers) * 100, 1) : 0;

        return [
            Stat::make('Total Users', $totalUsers)
                ->description('All registered users')
                ->descriptionIcon('heroicon-m-users')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3])
                ->color('info'),

            Stat::make('Pro Plan Users', $proUsers)
                ->description($percentagePro . '% of total users')
                ->descriptionIcon('heroicon-m-star')
                ->chart([2, 1, 2, 3, 2, 1, 4, 2])
                ->color('success'),

            Stat::make('Admin Users', $adminUsers)
                ->description($percentageAdmin . '% of total users')
                ->descriptionIcon('heroicon-m-shield-check')
                ->chart([1, 1, 1, 1, 1, 2, 1, 1])
                ->color('danger'),
        ];
    }
}
