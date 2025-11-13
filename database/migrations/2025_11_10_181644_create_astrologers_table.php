<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('astrologers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('userId');
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('email')->nullable();
            $table->string('countryCode')->nullable();
            $table->string('contactNo')->nullable();
            $table->string('whatsappNo')->nullable();
            $table->string('aadharNo')->nullable();
            $table->string('gstNo')->nullable();
            $table->string('pancardNo')->nullable();
            $table->string('gender')->nullable();
            $table->date('birthDate')->nullable();
            $table->string('primarySkill')->nullable();
            $table->string('allSkill')->nullable();
            $table->string('languageKnown')->nullable();
            $table->string('profileImage')->nullable();
            $table->string('astro_video')->nullable();
            $table->string('AstroFreePaid')->nullable();
            $table->decimal('charge', 10, 2)->nullable();
            $table->decimal('charge_usd', 10, 2)->nullable();
            $table->decimal('videoCallRate_usd', 10, 2)->nullable();
            $table->decimal('reportRate_usd', 10, 2)->nullable();
            $table->integer('experienceInYears')->nullable();
            $table->string('dailyContribution')->nullable();
            $table->string('hearAboutAstroguru')->nullable();
            $table->string('isWorkingOnAnotherPlatform')->nullable();
            $table->text('whyOnBoard')->nullable();
            $table->string('interviewSuitableTime')->nullable();
            $table->string('currentCity')->nullable();
            $table->string('mainSourceOfBusiness')->nullable();
            $table->string('highestQualification')->nullable();
            $table->string('degree')->nullable();
            $table->string('college')->nullable();
            $table->string('learnAstrology')->nullable();
            $table->unsignedBigInteger('astrologerCategoryId')->nullable();
            $table->string('instaProfileLink')->nullable();
            $table->string('facebookProfileLink')->nullable();
            $table->string('linkedInProfileLink')->nullable();
            $table->string('youtubeChannelLink')->nullable();
            $table->string('websiteProfileLink')->nullable();
            $table->string('isAnyBodyRefer')->nullable();
            $table->decimal('minimumEarning', 10, 2)->nullable();
            $table->decimal('maximumEarning', 10, 2)->nullable();
            $table->text('loginBio')->nullable();
            $table->integer('NoofforeignCountriesTravel')->nullable();
            $table->string('currentlyworkingfulltimejob')->nullable();
            $table->text('goodQuality')->nullable();
            $table->text('biggestChallenge')->nullable();
            $table->text('whatwillDo')->nullable();
            $table->boolean('isVerified')->default(false);
            $table->integer('totalOrder')->nullable();
            $table->string('country')->nullable();
            $table->boolean('isActive')->default(true);
            $table->boolean('isDelete')->default(false);
            $table->unsignedBigInteger('createdBy')->nullable();
            $table->unsignedBigInteger('modifiedBy')->nullable();
            $table->string('nameofplateform')->nullable();
            $table->decimal('monthlyEarning', 10, 2)->nullable();
            $table->string('referedPerson')->nullable();
            $table->boolean('chatStatus')->default(false);
            $table->integer('chatWaitTime')->nullable();
            $table->boolean('callStatus')->default(false);
            $table->integer('callWaitTime')->nullable();
            $table->decimal('videoCallRate', 10, 2)->nullable();
            $table->string('call_sections')->nullable();
            $table->string('chat_sections')->nullable();
            $table->string('live_sections')->nullable();
            $table->decimal('reportRate', 10, 2)->nullable();
            $table->string('aadhar_card')->nullable();
            $table->string('pan_card')->nullable();
            $table->string('certificate')->nullable();
            $table->string('ifscCode')->nullable();
            $table->string('bankName')->nullable();
            $table->string('bankBranch')->nullable();
            $table->string('accountType')->nullable();
            $table->string('accountNumber')->nullable();
            $table->string('accountHolderName')->nullable();
            $table->string('upi')->nullable();
            $table->decimal('emergency_video_chage', 10, 2)->nullable();
            $table->decimal('emergency_audio_charge', 10, 2)->nullable();
            $table->decimal('emergency_chat_charge', 10, 2)->nullable();
            $table->boolean('emergencyCallStatus')->default(false);
            $table->boolean('emergencyChatStatus')->default(false);
            $table->decimal('chat_discount', 10, 2)->nullable();
            $table->decimal('audio_discount', 10, 2)->nullable();
            $table->decimal('video_discount', 10, 2)->nullable();
            $table->boolean('isDiscountedPrice')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
            
    }

    public function down(): void {
        Schema::dropIfExists('astrologers');
    }
};
    