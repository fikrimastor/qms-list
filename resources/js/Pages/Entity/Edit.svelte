<script>

import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.svelte";
import UpdateEntityInformation from "@/Pages/Entity/Partials/UpdateEntityInformation.svelte";
import DeleteEntityForm from "@/Pages/Entity/Partials/DeleteEntityForm.svelte";

export let title, status, currentEntity;

</script>

<svelte:head>
	<title>{ title }</title>
</svelte:head>

<BreezeAuthenticatedLayout>
	<h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-white" slot="header">
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
						currentEntity="{currentEntity}"

				/>
			</div>

			<div
					class="bg-white p-4 shadow sm:rounded-lg sm:p-8 dark:bg-gray-800"
			>
				<DeleteEntityForm
						class="max-w-xl"
						status="{status}"
						currentEntity="{currentEntity}"

				/>
			</div>
		</div>
	</div>
</BreezeAuthenticatedLayout>