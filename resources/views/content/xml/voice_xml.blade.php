<?php echo '<?xml version="1.0" encoding="utf-8" ?>'; ?>
    <Response>
        <Say voice="alice">{{ $VoiceData->voice_text }}</Say>
        <Play>{{ $VoiceData->voiceAudio }}</Play>
    </Response>