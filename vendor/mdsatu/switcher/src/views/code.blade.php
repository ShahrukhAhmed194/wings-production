<style>
/* Switch Style */
.switcher_switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 26px;
}

.switcher_switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.switcher_slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    -webkit-transition: .4s;
    transition: .4s;
}

.switcher_slider:before {
    position: absolute;
    content: "";
    height: 20px;
    width: 20px;
    left: 2px;
    bottom: 3px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
}

.switcher_switch input:checked + .switcher_slider {
    background-color: #258391;
}

.switcher_switch input:focus + .switcher_slider {
    box-shadow: 0 0 1px #258391;
}

.switcher_switch input:checked + .switcher_slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
}

/* Rounded sliders */
.switcher_round {
    border-radius: 34px;
}

.switcher_round:before {
    border-radius: 50%;
}
/* End Switch Style */

/* Loader Animation */
.switch_loader {
position: fixed;
top: 0;
left: 0;
width: 100%;
text-align: center;
font-size: 40px;
background: rgb(0, 0, 0, .8);
height: 100vh;
z-index: 999999;
color: #fff;
padding-top: 45vh;
}
.switch_loader img{width: 40px;-webkit-animation: switch-loader 2s infinite linear;animation: switch-loader 2s infinite linear;}

@-webkit-keyframes switch-loader {
    0% {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100% {
        -webkit-transform: rotate(359deg);
        transform: rotate(359deg);
    }
}
@keyframes switch-loader {
    0% {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100% {
        -webkit-transform: rotate(359deg);
        transform: rotate(359deg);
    }
}
/* End Loader Animation */
</style>

@php
    if(config('switcher.loader') !==''){
        $loader = config('switcher.loader');
    }else{
        $loader = "data:image/png;base64,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";
    }
@endphp

<div class="switch_loader" style="display: none;">
    <img src="{{$loader}}" alt="Loader Animation">
</div>

<script>
    function changeSwitcherSwitch(table, column, id){
        document.querySelector('.switch_loader').style.display = 'block';

        let formData = new FormData();
        formData.append('_token', "{{csrf_token()}}");
        formData.append('table', table);
        formData.append('column', column);
        formData.append('id', id);

        fetch("{{route('changeSwitch')}}", {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok!');
            }
            return response.text();
        })
        .then(() => {
            document.querySelector('.switch_loader').style.display = 'none';
        })
        .catch(() => {
            document.querySelector('.switch_loader').style.display = 'none';
            alert('Something wrong!');
        });
    }
</script>
