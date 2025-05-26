<div class="row text-center py-5">
    <h5 class="text-center m-0 p-0">SEO Information</h5>
</div>
<div class="row mt-3">
   <!-- SEO & Analytics -->
    <div class="col-lg-6 mb-7">
        <x-metronic.label for="site_url" class="col-form-label fw-bold fs-6">{{ __('Site URL') }}</x-metronic.label>
        <x-metronic.input id="site_url" type="url" name="site_url"
            :value="old('site_url', optional($setting)->site_url)" placeholder="Site URL" />
    </div>

    <div class="col-lg-6 mb-7">
        <x-metronic.label for="meta_title" class="col-form-label fw-bold fs-6">{{ __('Meta Title') }}</x-metronic.label>
        <textarea id="meta_title" name="meta_title" rows="2" class="form-control form-control-solid">{{ old('meta_title', optional($setting)->meta_title) }}</textarea>
    </div>

    <div class="col-lg-6 mb-7">
        <x-metronic.label for="meta_keyword" class="fw-semibold fs-6 mb-2">{{ __('Meta Keyword') }}</x-metronic.label>
        <x-metronic.input id="meta_keyword" type="text" name="meta_keyword"
            :value="old('meta_keyword', optional($setting)->meta_keyword)" placeholder="keyword one, keyword two, ..." />
    </div>

    <div class="col-lg-6 mb-7">
        <x-metronic.label for="meta_tags" class="col-form-label fw-bold fs-6">{{ __('Meta Tags') }}</x-metronic.label>
        <textarea id="meta_tags" name="meta_tags" rows="2" class="form-control form-control-solid">{{ old('meta_tags', optional($setting)->meta_tags) }}</textarea>
    </div>

    <div class="col-lg-12 mb-7">
        <x-metronic.label for="meta_description" class="col-form-label fw-bold fs-6">{{ __('Meta Description') }}</x-metronic.label>
        <textarea id="meta_description" name="meta_description" rows="3" class="form-control form-control-solid">{{ old('meta_description', optional($setting)->meta_description) }}</textarea>
    </div>

    <div class="col-lg-12 mb-7">
        <x-metronic.label for="google_analytics" class="col-form-label fw-bold fs-6">{{ __('Google Analytics') }}</x-metronic.label>
        <textarea id="google_analytics" name="google_analytics" rows="5" class="form-control form-control-solid">{{ old('google_analytics', optional($setting)->google_analytics) }}</textarea>
    </div>
</div>
