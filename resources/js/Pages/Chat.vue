<template>
  <Head title="Chat" />

  <AuthenticatedLayout>
    <!-- <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Chat</h2>
    </template> -->

    <div class="py-2">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div
          class="bg-white shadow-sm sm:rounded-lg flex h-[85vh] overflow-hidden"
        >
          <div class="w-1/4 bg-gray-100 border-r border-gray-300">
            <div class="p-4 border-b border-gray-300 bg-white">
              <h3 class="text-lg font-semibold text-gray-800">Users</h3>
            </div>

            <ul class="overflow-y-auto h-full space-y-2 p-4">
              <li
                v-for="buddy in buddies"
                :key="buddy.id"
                class="flex items-center space-x-3 p-2 rounded-lg cursor-pointer hover:bg-gray-200 transition"
              >
                <img
                  src="https://via.placeholder.com/40"
                  alt="User 1"
                  class="w-10 h-10 rounded-full"
                />
                <div>
                  <div class="text-gray-800">User 1</div>
                  <div class="text-sm text-gray-500">Online</div>
                </div>
              </li>
            </ul>
          </div>

          <div class="flex-1 flex flex-col">
            <div
              class="flex items-center justify-between p-4 border-b border-gray-300 bg-gray-50"
            >
              <div class="flex items-center space-x-3">
                <img
                  src="https://via.placeholder.com/50"
                  alt="User 1"
                  class="w-12 h-12 rounded-full"
                />
                <div>
                  <p class="text-lg font-semibold text-gray-800">User 1</p>
                  <p class="text-sm text-gray-500">Online</p>
                </div>
              </div>
            </div>

            <div class="flex-1 p-6 overflow-y-auto">
              <div class="flex items-start mb-4">
                <div class="mr-3">
                  <div class="bg-blue-500 text-white rounded-lg p-3">
                    Hello, how are you?
                    <div class="text-xs text-gray-300 mt-1">10:15 AM</div>
                  </div>
                </div>
              </div>
              <div class="flex items-start mb-4 justify-end">
                <div class="ml-3">
                  <div class="bg-gray-300 text-black rounded-lg p-3">
                    I'm good, thanks!
                    <div class="text-xs text-gray-500 mt-1 text-right">
                      10:17 AM
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="border-t border-gray-300 p-4 bg-gray-50">
              <div class="flex items-center">
                <input
                  type="text"
                  class="w-full p-3 border rounded-lg focus:outline-none focus:ring focus:border-blue-300"
                  placeholder="Type your message..."
                />
                <button
                  class="ml-2 p-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600"
                >
                  Send
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
defineProps({
  buddies: Object,
});
</script>
