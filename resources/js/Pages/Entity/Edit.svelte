<script>

import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.svelte";
import UpdateEntityInformation from "@/Pages/Entity/Partials/UpdateEntityInformation.svelte";

export let title, status;

</script>

<svelte:head>
	<title>{ title }</title>
</svelte:head>

<BreezeAuthenticatedLayout>
	<h2 class="font-semibold text-xl text-gray-800 leading-tight" slot="header">
		{ title }
	</h2>

	<div class="py-12">
		<div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
			<div
					class="bg-white p-4 shadow sm:rounded-lg sm:p-8 dark:bg-gray-800"
			>
				<UpdateEntityInformation
						class="max-w-xl"
						status="{status}"
				/>
			</div>

		</div>
	</div>
</BreezeAuthenticatedLayout>