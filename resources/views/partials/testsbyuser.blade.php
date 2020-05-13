<tests-by-user
    :tests = " {{ json_encode($tests) }} "
    inline-template
>
    <div class="flex flex-wrap -mx-4 justify-center sm:justify-start text-teal-900 select-none" v-if="tests.length">
        <template v-for="test in tests.slice(0, Number(testsToShow ? testsToShow : 100))" >
            <test-deck
                :test="test"
                inline-template
                :key="test.id"
            >
                <div class="w-full max-w-lg sm:w-1/2 md:w-1/2 xl:w-1/3 px-4 overflow-hidden">
                    <div class="relative bg-white rounded-xl shadow-lg border-r-4 border-b-8 border-gray-500 h-56 mb-4 p-5 hoverparent overflow-hidden">
                        <h3 class="font-normal text-xl py-4 -mx-5 px-4 w-full border-l-4 border-teal-400 truncate">@{{ test.title }}</h3>

                        <div class="text-gray-600">
                            @{{ stringLimitDescription }}
                        </div>
                        @{{ test.decks.length }}
                    </div>
                </div>
            </test-deck>
        </template>
    </div>
</tests-by-user>
