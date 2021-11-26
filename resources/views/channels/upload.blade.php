@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <channel-uploads :channel="{{ $channel }}" inline-template>
                <div class="col-md-8">
                    <div class="card p-3 d-flex justify-content-center align-items-center" v-if="!selected">
                        <svg onclick="document.getElementById('video-files').click()" xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 48 48" width="48px" height="48px">
                            <path fill="#FF3D00"
                                  d="M43.2,33.9c-0.4,2.1-2.1,3.7-4.2,4c-3.3,0.5-8.8,1.1-15,1.1c-6.1,0-11.6-0.6-15-1.1c-2.1-0.3-3.8-1.9-4.2-4C4.4,31.6,4,28.2,4,24c0-4.2,0.4-7.6,0.8-9.9c0.4-2.1,2.1-3.7,4.2-4C12.3,9.6,17.8,9,24,9c6.2,0,11.6,0.6,15,1.1c2.1,0.3,3.8,1.9,4.2,4c0.4,2.3,0.9,5.7,0.9,9.9C44,28.2,43.6,31.6,43.2,33.9z"/>
                            <path fill="#FFF" d="M20 31L20 17 32 24z"/>
                        </svg>
                        <input type="file" multiple id="video-files" ref="videos" @change="upload" hidden>
                        <p class="text-center">Upload Videos</p>
                    </div>
                    <div class="card p-3" v-else>
                        <div class="my-4" v-for="video in videos">
                            <div class="progress mb-3">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                     :style="{ width: `${video.percentage || progress[video.name]}%` }"
                                     aria-valuenow="50" aria-valuemin="0"
                                     aria-valuemax="100">
                                    @{{ video.percentage ? video.percentage === 100 ? 'Video Processing completed.' : 'Processing' : 'Uploading' }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div v-if="!video.thumbnail"
                                         class="d-flex justify-content-center align-items-center"
                                         style="height: 180px; color: white; font-size: 18px">
                                        Loading thumbnail ...
                                    </div>
                                    <img v-else :src="video.thumbnail" style="width: 100%" alt="">
                                </div>
                                <div class="col-md-4">
                                    <a v-if="video.percentage && video.percentage === 100" target="_blank"
                                       :href="`/videos/${video.id}`">@{{ video.title }}</a>
                                    <h4 v-else class="text-center">
                                        @{{ video.title || video.name }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </channel-uploads>
        </div>
    </div>
@endsection
