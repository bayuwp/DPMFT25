<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Models\{
    ProkerTeknikMesin,
    ProkerPendidikanTeknikMesin,
    ProkerTataBoga,
    ProkerTataBusana,
    ProkerTataRias,
    ProkerTI,
    ProkerPTI,
    ProkerSI,
    ProkerTE,
    ProkerPTE,
    ProkerSipil,
    ProkerPTB,
    ProkerPWK,
    ProkerBEM,
    ProkerNotification
};
use App\Services\WhatsAppService;

class CheckProkerDocuments extends Command
{
    protected $signature = 'proker:check-documents';
    protected $description = 'Cek semua jurusan H-7 yang belum upload proposal/instrumen materi dan kirim WA';

    public function handle()
    {
        $start = Carbon::now()->addDays(7)->startOfDay();
        $end = Carbon::now()->addDays(7)->endOfDay();

        Log::info("📅 Scheduler dijalankan: " . now());
        Log::info("Target tanggal: {$start} s/d {$end}");

        $models = [
            ProkerTeknikMesin::class,
            ProkerPendidikanTeknikMesin::class,
            ProkerTataBoga::class,
            ProkerTataBusana::class,
            ProkerTataRias::class,
            ProkerTI::class,
            ProkerPTI::class,
            ProkerSI::class,
            ProkerTE::class,
            ProkerPTE::class,
            ProkerSipil::class,
            ProkerPTB::class,
            ProkerPWK::class,
            ProkerBEM::class,
        ];

        foreach ($models as $model) {
            $prokers = $model::whereBetween('tanggal', [$start, $end])
                ->where(function ($q) {
                    $q->whereNull('proposal')
                        ->orWhereNull('instrumen_materi');
                })
                ->get();

            $this->info("🔍 {$model} - ditemukan {$prokers->count()} proker");
            Log::info("🔍 {$model} - ditemukan {$prokers->count()} proker");

            foreach ($prokers as $proker) {
                $exists = ProkerNotification::where('model', $model)
                    ->where('proker_id', $proker->id)
                    ->exists();

                if ($exists) {
                    $this->warn("⚠️ Sudah pernah kirim: {$proker->nama_proker}");
                    Log::warning("⚠️ Sudah pernah kirim: {$proker->nama_proker}");
                    continue;
                }

                $message = "⚠️ Reminder: Proposal atau Instrumen Materi untuk proker *{$proker->nama_proker}* (tanggal: {$proker->tanggal}) belum diunggah. Mohon segera upload.";

                if (!empty($proker->nomor_wa)) {
                    $success = WhatsAppService::sendMessage($proker->nomor_wa, $message);
                    if ($success) {
                        ProkerNotification::create([
                            'model' => $model,
                            'proker_id' => $proker->id,
                            'message' => $message,
                        ]);
                        $this->info("✅ WA terkirim ke {$proker->nama_proker} ({$proker->nomor_wa})");
                        Log::info("✅ WA terkirim ke {$proker->nama_proker} ({$proker->nomor_wa})");
                    } else {
                        $this->error("❌ Gagal kirim WA ke {$proker->nomor_wa}");
                        Log::error("❌ Gagal kirim WA ke {$proker->nomor_wa}");
                    }
                } else {
                    $this->warn("⚠️ Nomor WA kosong untuk proker {$proker->nama_proker}");
                    Log::warning("⚠️ Nomor WA kosong untuk proker {$proker->nama_proker}");
                }
            }
        }
    }
}
