<template>
  <Head title="Chat" />

  <AuthenticatedLayout>
    <div class="py-2">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div
          class="bg-white shadow-sm sm:rounded-lg flex h-[85vh] overflow-hidden"
        >
          <div class="w-1/4 bg-gray-100 border-r border-gray-300">
            <div class="p-4 border-b border-gray-300 bg-white">
              <input
                type="text"
                class="w-full p-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300"
                placeholder="Search users..."
              />
            </div>

            <ul class="overflow-y-auto h-full space-y-2 p-4">
              <li v-for="buddy in buddies" :key="buddy.id">
                <Link
                  :href="route('chat', buddy.id)"
                  class="flex items-center space-x-3 p-2 rounded-lg cursor-pointer hover:bg-gray-200 transition"
                  @click="selectBuddy(buddy)"
                >
                  <img
                    :src="buddy.image || 'https://via.placeholder.com/40'"
                    alt="User Image"
                    class="w-10 h-10 rounded-full"
                  />
                  <div>
                    <div class="text-gray-800">{{ buddy.name }}</div>
                    <div class="text-sm text-gray-500">{{ buddy.status }}</div>
                  </div>
                </Link>
              </li>
            </ul>
          </div>

          <div class="flex-1 flex flex-col">
            <!-- Loading  -->
            <div v-if="loading" class="flex justify-center items-center h-full">
              <div class="text-gray-500">Loading...</div>
            </div>

            <div v-else-if="buddy" class="flex flex-col h-full">
              <div
                class="flex items-center justify-between p-4 border-b border-gray-300 bg-gray-50"
              >
                <div class="flex items-center space-x-3">
                  <img
                    :src="buddy.image || 'https://via.placeholder.com/50'"
                    alt="User Image"
                    class="w-12 h-12 rounded-full"
                  />
                  <div>
                    <p class="text-lg font-semibold text-gray-800">
                      {{ buddy.name }}
                    </p>
                    <p class="text-sm text-gray-500">{{ buddy.status }}</p>
                  </div>
                </div>
              </div>

              <div class="flex-1 p-6 overflow-y-auto">
                <div
                  v-if="messages.length === 0"
                  class="text-gray-500 text-center"
                >
                  No messages yet.
                </div>

                <div v-else>
                  <div
                    v-for="(message, index) in messages"
                    :key="index"
                    :class="
                      message.sender_id === $page.props.auth.user.id
                        ? 'flex items-start mb-4 justify-end'
                        : 'flex items-start mb-4'
                    "
                  >
                    <div
                      :class="
                        message.sender_id === $page.props.auth.user.id
                          ? 'mr-3'
                          : 'ml-3'
                      "
                    >
                      <div
                        :class="
                          message.sender_id === $page.props.auth.user.id
                            ? 'bg-blue-500 text-white'
                            : 'bg-gray-300 text-black'
                        "
                        class="rounded-lg p-3"
                      >
                        {{ message.message }}
                        <div
                          class="text-xs text-gray-300 mt-1"
                          :class="
                            message.sender_id === $page.props.auth.user.id
                              ? 'text-gray-300'
                              : 'text-slate-500'
                          "
                        >
                          {{ formatTime(message.created_at) }}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="border-t border-gray-300 p-4 bg-gray-50">
                <div class="flex items-center">
                  <input
                    type="text"
                    v-model="newMessage"
                    class="w-full p-3 border rounded-lg focus:outline-none focus:ring focus:border-blue-300"
                    placeholder="Type your message..."
                  />
                  <button
                    @click="sendMessage"
                    class="ml-2 p-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600"
                  >
                    Send
                  </button>
                </div>
              </div>
            </div>

            <div v-else class="flex justify-center items-center h-full">
              <div class="text-gray-500">Select a user to start chatting.</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { ref } from "vue";

defineProps({
  buddies: Array,
  messages: Array,
  buddy: Object,
});

const loading = ref(false);
const newMessage = ref("");

const formatTime = (timestamp) => {
  const date = new Date(timestamp);
  return date.toDateString();
};

const selectBuddy = (buddy) => {
  loading.value = true;
  setTimeout(() => {
    loading.value = false;
  }, 1000);
};

const sendMessage = () => {
  if (newMessage.value.trim() === "") return;
  console.log("Message sent:", newMessage.value);

  newMessage.value = "";
};
</script>
