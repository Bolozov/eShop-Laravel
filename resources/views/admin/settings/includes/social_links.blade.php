<div class="tile">
    <form action="{{ route('admin.settings.update') }}" method="POST" role="form">
        @csrf
        <h3 class="tile-title">Liens Réseaux Social</h3>
        <hr>
        <div class="tile-body">
            <div class="form-group">
                <label class="control-label" for="social_facebook">Page Facebook</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Entrez le lien de Page Facebook"
                    id="social_facebook"
                    name="social_facebook"
                    value="{{ config('settings.social_facebook') }}"
                />
            </div>
            <div class="form-group">
                <label class="control-label" for="social_twitter">Profil Twitter</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Entrer lien de profil Twitter"
                    id="social_twitter"
                    name="social_twitter"
                    value="{{ config('settings.social_twitter') }}"
                />
            </div>
            <div class="form-group">
                <label class="control-label" for="social_instagram">Profil Instagram</label>
                <input
                    class="form-control"
                    type="text"
                    placeholder="Entrez le lien du profil Instagram"
                    id="social_instagram"
                    name="social_instagram"
                    value="{{ config('settings.social_instagram') }}"
                />
            </div>

        </div>
        <div class="tile-footer">
            <div class="row d-print-none mt-2">
                <div class="col-12 text-right">
                    <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Mettre à jour</button>
                </div>
            </div>
        </div>
    </form>
</div>
