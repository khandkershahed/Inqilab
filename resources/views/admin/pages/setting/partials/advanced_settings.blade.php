<div class="row text-center py-5">
    <h5 class="text-center m-0 p-0">Email Settings</h5>
</div>

<div class="row mt-3">
    {{--
    $table->boolean('enable_email_verification')->default(false);
    $table->boolean('enable_api_access')->default(false);
    $table->boolean('enable_multilanguage')->default(false);
    $table->boolean('is_demo')->default(false); --}}
    <div class="form-check form-check-custom form-check-solid mb-7">
        <input class="form-check-input" type="checkbox" name="maintenance_mode" id="maintenance_mode" value="1"
            {{ old('maintenance_mode') ? 'checked' : 'checked' }}>
        <label class="form-check-label" for="maintenance_mode">
            Maintenance Mode
        </label>
    </div>
    <div class="form-check form-check-custom form-check-solid mb-7">
        <input class="form-check-input" type="checkbox" name="enable_user_registration" id="enable_user_registration"
            value="1" {{ old('enable_user_registration') ? 'checked' : 'checked' }}>
        <label class="form-check-label" for="enable_user_registration">
            Enable User Registration
        </label>
    </div>
    <div class="form-check form-check-custom form-check-solid mb-7">
        <input class="form-check-input" type="checkbox" name="enable_email_verification" id="enable_email_verification"
            value="1" {{ old('enable_email_verification') ? 'checked' : 'checked' }}>
        <label class="form-check-label" for="enable_email_verification">
            Enable Email Verification
        </label>
    </div>
    <div class="form-check form-check-custom form-check-solid mb-7">
        <input class="form-check-input" type="checkbox" name="enable_api_access" id="enable_api_access" value="1"
            {{ old('enable_api_access') ? 'checked' : 'checked' }}>
        <label class="form-check-label" for="enable_api_access">
            Enable API Access
        </label>
    </div>
    <div class="form-check form-check-custom form-check-solid mb-7">
        <input class="form-check-input" type="checkbox" name="enable_multilanguage" id="enable_multilanguage"
            value="1" {{ old('enable_multilanguage') ? 'checked' : 'checked' }}>
        <label class="form-check-label" for="enable_multilanguage">
            Enable Multilanguage
        </label>
    </div> 
</div>
