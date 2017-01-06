<?php

namespace App\Builders;

class ElasticMapping {

	public static function gather() {

		$path = base_path() . '/app/Models/';

		$files = scandir($path);

		$mappings = [];

		foreach ($files as $name) {
			if ($name !== '.' && $name !== '..') {
				$class_name = '\App\Models\\' . substr($name, 0, strlen($name) - 4);

				$class = new $class_name;

				// if the class import the searchable trait
				if (method_exists($class, 'search')) {

					// user defined method
					if (method_exists($class, 'getFieldMappings')) {

						$mappings['_default_'] = [
							'_all' => [
								'enabled' => false,
							],
						];

						$mappings[$class->searchableAs()] = [

							// 默认不在_all中显示
							'include_in_all' => false,
							// 禁用日期检测
							'date_detection' => false,
							// 当遇到未知字段时抛出异常
							'dynamic' => 'strict',
							'_all' => [
								'index_analyzer' => 'ik_max_word',
								// 'analyzer' => 'ik_max_word',
								'search_analyzer' => 'ik_max_word',
								'term_vector' => 'no',
								'store' => 'false',
							],
							'_source' => [
								'enabled' => true,
							],
							'properties' => $class->getFieldMappings(),
						];
					} else {
						// $mappings[$class->searchableAs()] = [];
					}
				}
			}
		}

		return $mappings;
	}
}