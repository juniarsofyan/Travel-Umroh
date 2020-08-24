<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Detail Itinerary</h3>
            </div>
            <div class="box-body">
                @for($i = 0; $i < $jumlahHari; $i++)
                    <div class="row">
                        <div class="col-xs-1">
                            <div class="form-group">
                                <label>{{ $i+1 }}.</label>
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <div class="form-group">
                                <label for="hari_ke{{ $i }}">Hari ke:</label>
                                {{-- <input type="number" step="1" min="9" id="hari_ke{{ $i }}" required> --}}
                                <select name="hari_ke{{ $i }}" id="hari_ke{{ $i }}" wire:model="daftarKegiatan[{{ $i }}]['hari_ke']" class="form-control" required>
                                    @for($a = 1; $a <= $jumlahHari; $a++)
                                        <option>{{ $a }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-3">
                            <div class="form-group">
                                <label for="kegiatan{{ $i }}">Kegiatan</label>
                                <textarea wire:model="daftarKegiatan[{{ $i }}]['kegiatan']" id="kegiatan{{ $i }}" class="form-control" cols="5" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="keterangan{{ $i }}">Keterangan</label>
                                <textarea wire:model="daftarKegiatan[{{ $i }}]['keterangan']" id="keterangan{{ $i }}" class="form-control" cols="5" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <div class="form-group">
                                <label for="estimasi{{ $i }}">Estimasi (Jam)</label>
                                <input type="number" wire:model="daftarKegiatan[{{ $i }}]['estimasi']" step="1" min="9" class="form-control" id="estimasi{{ $i }}" required>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>
</div>