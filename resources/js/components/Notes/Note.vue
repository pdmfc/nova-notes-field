<template lang="html">
        <li class="flex text-left bg-indigo shadow overflow-hidden px-4 py-4">
          <div class="mr-4 flex-shrink-0">
              <img class="inline-block h-16 w-16 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />
          </div>
          <div>
            <h4 class="text-lg font-bold">Utilizador</h4>
            <p class="mt-1">
                {{ data.note }} <br>
                {{ moment(data.created_at).fromNow() }} -
                {{ moment(data.created_at).format('DD/MM/YY HH:mm') }}
            </p>

            <div class="mt-6 flex">
              <div class="mr-4 flex-shrink-0">
                <svg class="h-12 w-12 border border-gray-300 bg-white text-gray-300" preserveAspectRatio="none" stroke="currentColor" fill="none" viewBox="0 0 200 200" aria-hidden="true">
                  <path vector-effect="non-scaling-stroke" stroke-width="1" d="M0 0l200 200M0 200L200 0" />
                </svg>
              </div>
              <div>
                <h4 class="text-lg font-bold">Lorem ipsum</h4>
                <p class="mt-1">
                  Repudiandae sint consequuntur vel. Amet ut nobis explicabo numquam expedita quia omnis voluptatem. Minus quidem ipsam quia iusto.
                </p>
              </div>
            </div>
            <div class="mt-6 flex">
              <div class="mr-4 flex-shrink-0">
                <svg class="h-12 w-12 border border-gray-300 bg-white text-gray-300" preserveAspectRatio="none" stroke="currentColor" fill="none" viewBox="0 0 200 200" aria-hidden="true">
                  <path vector-effect="non-scaling-stroke" stroke-width="1" d="M0 0l200 200M0 200L200 0" />
                </svg>
              </div>
              <div>
                <h4 class="text-lg font-bold">Lorem ipsum</h4>
                <p class="mt-1">
                  Repudiandae sint consequuntur vel. Amet ut nobis explicabo numquam expedita quia omnis voluptatem. Minus quidem ipsam quia iusto.
                </p>
              </div>
            </div>

          </div>
      </li>
</template>

<script>
import moment from 'moment'
import locales from 'moment/locale/pt'

const a = 1

export default {
    props: {
        data: {
            type: Array,
            required: true
        }
    },
    created () {
        this.moment().locale('pt', pt) // TODO: Nova.confiig.locale
    },
    methods: {
        moment
    }
}
</script>

<style lang="css" scoped src="../../../sass/tailwind.css">>
</style>
