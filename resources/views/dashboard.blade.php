<x-app-layout>
    <div class="flex h-screen antialiased text-gray-800">
        <div class="flex flex-row h-full w-full overflow-x-hidden">
          <div class="flex flex-col py-8 pl-6 pr-2 w-64 bg-white flex-shrink-0">
            <div class="flex flex-row items-center justify-center h-12 w-full">
              <div class="flex items-center justify-center rounded-2xl text-indigo-700 bg-indigo-100 h-10 w-10">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                </svg>
              </div>
              <div class="ml-2 font-bold text-2xl">Chats</div>
            </div>

            {{-- Conversations list --}}
            <div class="flex flex-col mt-8">
              <div class="flex flex-row items-center justify-between text-xs">
                <span class="font-bold">Conversations</span>
              </div>
              <div class="flex flex-col space-y-1 mt-4 -mx-2 h-48" id="user-list">
                <a class="flex flex-row items-center hover:bg-gray-100 rounded-xl p-2">
                  <img class="object-cover w-10 h-10 rounded-full" src="{{url('images/no-user-image.jpg')}}" alt="username" />
                  <div class="ml-2 text-sm font-semibold">Marta Curtis</div>
                </a>
              </div>
            </div>
            {{-- /Conversations list --}}
          </div>

          <div class="flex flex-col flex-auto h-full p-6">
            <div class="flex flex-col flex-auto flex-shrink-0 rounded-2xl bg-gray-100 h-full p-4">

              {{-- Messages --}}
              <div class="relative flex items-center p-3 border-b border-gray-300">
                  <img class="object-cover w-10 h-10 rounded-full" src="{{url('images/no-user-image.jpg')}}" alt="username" />
                  <span class="block ml-2 font-bold text-gray-600" id="selected-user-name">Kelly Dev</span>
              </div>
              <div class="flex flex-col h-full overflow-x-auto mb-4">
                <div class="flex flex-col h-full">
                  <div class="grid grid-cols-12 gap-y-2" id="message-box">
                    
                  </div>
                </div>
              </div>
              {{-- /Messages --}}

              <div class="flex flex-row items-center h-16 rounded-xl bg-white w-full px-4">
                <div class="flex-grow ml-4">
                  <div class="relative w-full">
                    <input type="text" placeholder="Message" class="flex w-full border rounded-xl focus:outline-none focus:border-indigo-300 pl-4 h-10" name="message" id="message" required />
                    <input type="hidden" id="selected-user-id">
                  </div>
                </div>
                <div class="ml-4">
                  <button type="submit" id="sendMessage" class="flex items-center justify-center bg-indigo-500 hover:bg-indigo-600 rounded-xl text-white px-4 py-1 flex-shrink-0">
                    <span>Send</span>
                    <span class="ml-2">
                      <svg class="w-4 h-4 transform rotate-45 -mt-px" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                      </svg>
                    </span>
                  </button>
                </div>
              </div>

            </div>
          </div>

          {{-- template start  --}}
          <template id="user-template">
                <button class="flex flex-row items-center hover:bg-gray-100 rounded-xl p-2 user-item" id="user_##id##" data-id="##id##" data-name="##name##">
                  <img class="object-cover w-10 h-10 rounded-full" src="{{url('images/no-user-image.jpg')}}" alt="##name##" />
                  <div class="ml-2 text-sm font-semibold">##name##</div>
                </button>
          </template>
          <template id="received-message">
              <div class="col-start-1 col-end-8 p-3 rounded-lg">
                  <div class="flex flex-row items-center">
                    <img class="object-cover w-10 h-10 rounded-full" src="{{url('images/no-user-image.jpg')}}" alt="username" />
                    <div class="relative ml-3 text-sm bg-white py-2 px-4 shadow rounded-xl">
                      <div>##text##</div>
                    </div>
                  </div>
              </div>
          </template>
          <template id="sent-message">
              <div class="col-start-6 col-end-13 p-3 rounded-lg" id="message_##id##" data-id="##id##">
                  <div class="flex items-center justify-start flex-row-reverse">
                    <img class="object-cover w-10 h-10 rounded-full" src="{{url('images/no-user-image.jpg')}}" alt="username" />
                    <div class="relative mr-3 text-sm bg-indigo-100 py-2 px-4 shadow rounded-xl">
                      <div>##text##</div>
                    </div>
                    <button class="delete-button" onclick="deleteMessage('##id##')">
                        <img src="{{url('images/delete-icon.svg')}}" alt="delete" >
                    </button>
                  </div>
              </div>
          </template>
          {{-- template end  --}}
        </div>
    </div>

</x-app-layout>
