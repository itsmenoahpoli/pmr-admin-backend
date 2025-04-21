<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patient_ie', function (Blueprint $table) {
            // TODO: Ocular inspection

            $table->id();
            $table->foreignId('patient_profile_id')->constrained('patient_profiles')->cascadeOnDelete();
            $table->string('physical_therapist_name');
            $table->string('rehab_md')->nullable();
            $table->string('referring_md')->nullable();
            $table->text('chief_complaint')->nullable();
            $table->text('history_of_present_illness')->nullable(); // trauma/surgery/others
            $table->text('medical_intervention')->nullable(); //  { type: xray/mri/ct/emg-ncv/us, date: yyyy-mm-dd, results: string, medications: string }
            $table->text('comorbidities')->nullable(); // na/htn/dm/ca/allergy/others
            $table->text('vital_signs')->nullable(); // { vital: bp(mmHg)/PR(bpm)/O2 Sat(%)/Temp(C), before: string, after: string }
            $table->text('palpation')->nullable(); // { type: [array]hyperthermic/hypertonic/normothermic/normotonic/hypothermic/hypotonic, spasticity+-: string, terderness+-: string, edema+-: string, muscle_spasm+-: string, muscle_guarding+-: string, muscle_tightness+-: string, contracture+-: string, nodule_or_taut_bands+-: string, others: string}
            $table->text('ROM')->nullable(); // array{motion: string, active: string, passive: string, difference: { active: string, passive: string }, end_feel: string }
            $table->text('MMT')->nullable(); // array{ muscle_group: string, grade: string }
            $table->text('neurologic_assesment')->nullable();
            $table->text('other_test_measures')->nullable(); // { special_test+-: string, cn_testing+-: string, lld: string, mbm: string, others: string }
            $table->text('postural_assesment')->nullable(); // { head: string, shoulder: string, trunk: string, hip: string, knee: string, ankle: string, foot: string }
            $table->text('galt_assesment')->nullable(); // { ic: { left: +-, right: +- }, lr: { left: +-, right: +-, others: string }, mst: { left: +-, right: +-, others: string }, tst: { left: +-, right: +-, others: string }, psw: { left: +-, right: +-, others: string }, lsw: { left: +-, right: +-, others: string }, msw: { left: +-, right: +-, others: string }, tsw: { left: +-, right: +-, others: string } }
            $table->text('pt_impression')->nullable();
            $table->text('plan_of_care')->nullable(); // [hot_packs, cold_packs, therapeutic_us, tens/fes/es, shockwave, microcurrent, irr, dry_needling, electro_needling, astr, cupping_theraphy, trigenics, spinal_manipulation, functional_therapeutic_exercises]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_i_e_s');
    }
};
