@vite('resources/css/app.css')
<footer class="bg-orange-200 lg:grid lg:grid-cols-5">
  <div class="relative block h-16 lg:col-span-2 lg:h-full"> <!-- Adjusted height -->
    <img
      src="img/footer.jpg"
      alt="footer-logo"
      class="absolute inset-0 h-full w-full object-cover"
    />
    <div class="absolute inset-0 bg-black opacity-50"></div>
  </div>

  <div class="px-4 py-16 sm:px-6 lg:col-span-3 lg:px-8">
    <div class="grid grid-cols-1 gap-8 sm:grid-cols-2">
      <div>
        <p>
          <span class="uppercase tracking-wide font-medium text-black"> Bel ons </span>
          <p class="block text-2xl font-medium text-black sm:text-2xl">
            0123456789
          </p> <!-- Fixed closing tag for <p> -->
        </p>
      </div>

      <div class="mt-8 sm:mt-0"> <!-- Adjusted margin -->
        <!-- Email Section -->
        <div class="mb-12"> <!-- Adjusted margin -->
            <p class="font-medium text-black">Email</p>
            <ul class="mt-2 space-y-4 text-sm">
                <li>
                    <p class="text-black">kitesurfschool@gmail.com</p>
                </li>
            </ul>
        </div>

        <!-- Address Section -->
        <div>
            <p class="font-medium text-gray-900">Adres</p>
            <ul class="mt-2 space-y-4 text-sm">
                <li>
                    <p class="text-black">Australiëlaan 25, 3526 AB Utrecht</p>
                </li>
            </ul>
        </div>
      </div>
    </div>
  </div>
</footer>
