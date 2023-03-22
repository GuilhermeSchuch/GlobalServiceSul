    <footer>
        {{-- <a href="https://wa.link/yg7mu4"> --}}
            <div class="social-links" onclick="handleWhats()">
                <div id="whats" class="social-btn flex-center">
                    <img src="{{ url('img/whats.svg') }}" alt=""><span>Suporte</span>
                </div>
            </div>
        {{-- </a> --}}
    </footer>


    <script>
        const handleWhats = () => {
            window.location.href = "https://wa.link/yg7mu4";
        }
    </script>


    {{-- JQUERY --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js" integrity="sha512-tWHlutFnuG0C6nQRlpvrEhE4QpkG1nn2MOUMWmUeRePl4e3Aki0VB6W1v3oLjFtd0hVOtRQ9PHpSfN6u6/QXkQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- BOOTSTRAP --}}
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    {{-- CUSTOM JS --}}
    <script src="{{url('js/register.js')}}"></script>
    <script src="{{url('js/msg_fade_out.js')}}"></script>

    </body>
</html>
